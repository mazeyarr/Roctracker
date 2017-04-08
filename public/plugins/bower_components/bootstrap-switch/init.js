$(".bt-switch input[type='checkbox'], .bt-switch input[type='radio']").bootstrapSwitch();
var radioswitch = function() {
    var bt = function() {
        $("body").on("switch-change", function() {
            $(".radio-switch").bootstrapSwitch("toggleRadioState")
            alert(1);
        }),
        $("body").on("switch-change", function() {
            $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck")
            alert(1);
        }),
        $("body").on("switch-change", function() {
            $(".radio-switch").bootstrapSwitch("toggleRadioStateAllowUncheck", !1)
            alert(1);
        })
    };
    return {
        init: function() {
            bt()
        }
    }
}();