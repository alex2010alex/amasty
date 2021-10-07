Vue.createApp({
    data(){
        return {
            nominal: [],
            response: false,
            sum: ""
        };
    },
    computed: {
        getNominals(){
            return this.nominal.join(", ");
        }
    },
    methods: {
        sendRequest(action, sum = false){
            if(action){
                let xml = new XMLHttpRequest();
                let query = "?action=" + action;
                console.log(this.sum);
                if(sum && this.sum){
                    query += "&sum=" + this.sum;
                }

                xml.open("get", "core/index.php" + query);
                xml.onreadystatechange = () => {
                    if(xml.status == 200 && xml.readyState == 4){
                        resp = JSON.parse(xml.responseText);
                        if(resp['RESULT'] && resp['STATUS'] != 'ERROR'){
                            resp['RESULT'] = JSON.parse(resp['RESULT']);
                        }
                        else if(resp['STATUS'] == 'ERROR') {
                            resp['RESULT'] = JSON.parse(decodeURI(resp['RESULT']));
                            console.log(decodeURI(resp['RESULT']));
                        }
                        
                        if(action == 'nominals'){
                            this.nominal = resp;
                        }
                        else if(action == 'calculate'){
                            this.response = resp;
                            console.log(this.response);
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
        }
    },
    created(){
        console.log(this.sendRequest('nominals'));
    }
}).mount(".bankomat");