//create a class delivery 
function Delivery(){
this.name='';
this.period='';

    this.passName=function(aName){
        this.name=aName;
    };

    this.getPeriod=function(aPeriod){
        this.period=aPeriod;
        
        json=JSON.stringify({"name" : this.name, "period" : this.period});
        this.show(json);
    };
    
    this.show=function(arg){
        var ajax= new XMLHttpRequest();
        ajax.onreadystatechange=function(){
            if(this.readyState === 4 && this.status ===200){
//                var a=this.responseText;
                document.getElementById("content").innerHTML=this.responseText;
            }
        };
        ajax.open("GET", "delivery_report.php?q="+arg);
        ajax.send(); 
       
    };
}



