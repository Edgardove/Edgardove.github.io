$(document).ready(function(){
    $('.entry').val('');

    let decimal_input=$('#decimal_input'), decimal_output=$('#decimal_output'),
        binary_input=$('#binary_input'), binary_output=$('#binary_output');

    decimal_input.on('input', function(){
        let allowed=this.value.replace(/[^0-9\-\.]/,'');

        $(this).val(allowed);

        let result=decimal_to_binary($(this).val());

        $('#binary_output').text(result);
    });

    binary_input.on('input', function(){
        let allowed=this.value.replace(/[^0-1\-\.]/,'');

        $(this).val(allowed);

        let result=binary_to_decimal($(this).val());

        $('#decimal_output').text(result);
    });

    function decimal_to_binary(n){
        let int=isNaN(parseInt(n.split('.')[0])) ? 0 : parseInt(n.split('.')[0]), 
            frac=isNaN(parseFloat(n.split('.')[1])) ? 0 : parseFloat('0.' + n.split('.')[1]),
            sign='', output='';

        if(int<0 || 1/int===-Infinity) sign='-';

        int=Math.abs(int);   
        
        if(int==0 && frac==0){
            return '0';
        }

        if(int>0){
            while(int!=1){
                output+=''+int%2;
                int=Math.floor(int/2);
            }

            output+='1';

            output=reverse(output);
        }
        else output='0';

        if(frac>0){
            output+='.';

            for(i=0;i<23;i++){
                frac=frac*2;
                if(frac<1) output+='0';

                else if(frac>1){
                    n=frac.toString();
                    frac=parseFloat('0.' + n.split('.')[1]);
                    output+='1';
                }
            }
        }

        return sign+output;
    }

    function binary_to_decimal(n){
        let int=isNaN(parseInt(n.split('.')[0])) ? 0 : parseInt(n.split('.')[0]), 
            frac=isNaN(parseFloat(n.split('.')[1])) ? 0 : parseFloat('0.' + n.split('.')[1]),
            sign=1, output=0;

        if(int<0) sign=-1;

        int=(''+int).replace(/[-]/g,'');

        frac=(''+parseFloat('0.' + n.split('.')[1])).replace(/0./,'');

        let c=int.length-1;

        for(i=0;i<int.length;i++){
            output+=parseInt(int[i])*Math.pow(2,c);
            c--;
        }

        for(i=0;i<frac.length;i++){
            output+=parseInt(frac[i])*Math.pow(2,-(i+1));
        }

        return output*sign; 
    }

    function reverse(s){
        return s.split("").reverse().join("");
    }
});