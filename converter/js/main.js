Vue.createApp({
    data(){
        return {
            date: "",
            sum: "",
            from: "",
            to: "",
            curs: [],
            endCurs: "",
            endSum: "",
            endTo: "",
            maxDate: new Date().getFullYear() + "-" + String(new Date().getMonth()).padStart(2, "0") + "-" + String(new Date().getDate()).padStart(2, "0"),
            falseR: false
        };
    },
    computed: {
        getFrom(){
            if(this.to){
                let copy = this.copyObject(this.curs);
                copy.splice(copy.indexOf(this.to), 1);

                return copy;
            }
            else {
                return this.curs;
            }
        },
        getTo(){
            if(this.from){
                let copy = this.copyObject(this.curs);
                copy.splice(copy.indexOf(this.from), 1)

                return copy;
            }
            else {
                return this.curs;
            }
        }
    },
    methods: {
        copyObject(obj){
            return JSON.parse(JSON.stringify(obj));
        },
        sendRequest(action){
            if(action){
                let xml = new XMLHttpRequest();
                let query = "?action=" + action;

                if(action == "convert"){
                    query += `&date=${this.date}&sum=${this.sum}&from=${this.from}&to=${this.to}`;
                }

                xml.open("get", "core/index.php" + query);
                xml.onreadystatechange = () => {
                    if(xml.status == 200 && xml.readyState == 4){

                        try{
                            resp = JSON.parse(xml.responseText);
                            
                            if(action == 'getCurr'){
                                this.curs = resp;
                            }
                            else if(action == 'convert'){
                                this.endCurs = resp["curs"];
                                this.endSum = resp["sum"];
                                this.endTo = resp["to"];
                            }

                            this.falseR = false;
                        }
                        catch{
                            this.falseR = true;
                        }
                    }
                };
                xml.send(true);
            }
        },
        validateInput(e){
            console.log(e.target.value.length);
            if(!parseInt(e.data) && e.data != 0){
                e.target.value = e.target.value.replace(e.data, "");
            };
            this.sum = e.target.value;

            this.sendRequest("convert");
        }
    },
    created(){
        console.log(this.sendRequest('getCurr'));
    }
}).mount(".converter");