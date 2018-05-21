window.onload = function () {
    var handler = new Handlers();
    handler.startListeners()

}
//create a class delivery 
function Delivery() {
    //create getter and setter values for branch name, period and display type
    branch = {
        get name() {
            return this._name
        },
        set name(val) {
            this._name = val
        }
    };

    period = {
        get period() {
            return this._period
        },
        set period(aPeriod) {
            this._period = aPeriod
        }
    };

    display = {
        get display() {
            return this._display
        },
        set display(aDisplay) {
            this._display = aDisplay
        }
    };



    //use this method to process the information 
    this.process = function () {
        //test if a user has selected all three options
        if (!this.branch && !this.period && !this.display) {
            alert('You have to select atleast 1 option');
        } else {

            var json = JSON.stringify({
                "name": this.branch,
                "period": this.period,
                "display": this.display
            });

            window.open("delivery_report.php?q=" + json);
        }
<<<<<<< HEAD
=======

        var json = JSON.stringify({
            "name": this.branch,
            "period": this.period,
            "display": this.display
        });

        window.open("delivery_report.php?q=" + json);
>>>>>>> feat-active-marker
    }
}

//create a class for all handlers and exception 
//methods housed in here will be primarily used for event handling and exception cating
function Handlers() {
    //this is a method to assign click listeners when the page has loaded
    this.startListeners = function () {
        let client = document.getElementsByClassName('client');
        let period = document.getElementsByClassName('period');
        let display = document.getElementsByClassName('display');
        let ok = document.getElementById('continue');
        let cancel = document.getElementById('cancel');
<<<<<<< HEAD

=======
>>>>>>> feat-active-marker

        this_=this;
        for (x in client) {
            client[x].onclick = function () {
                delivery.branch = this.textContent;
<<<<<<< HEAD
=======
                this_.activeSelector("branch", this);

>>>>>>> feat-active-marker
            }
        }

        for (x in period) {
            period[x].onclick = function () {
                delivery.period = this.textContent;
<<<<<<< HEAD
=======
                this_.activeSelector("period", this);
>>>>>>> feat-active-marker
            }
        }

        for (x in display) {
            display[x].onclick = function () {
                delivery.display = this.id;
<<<<<<< HEAD
=======
                this_.activeSelector("content", this);
>>>>>>> feat-active-marker
            }
        }

        ok.onclick = function () {
            delivery.process()
        }
    };
<<<<<<< HEAD
=======
    //write a method activeSelector that takes one parameter html id
    //The first parameter is a html id. 
    this.activeSelector = function (id_param, button) {
        let container = document.getElementById(id_param);
        let current = container.getElementsByClassName("active");
        if (!current[0]) {
            console.log(this.className);
            button.className += " active";
        } else {
            current[0].className = current[0].className.replace(" active", "");
            button.className += " active";
        }
    }
>>>>>>> feat-active-marker


}
