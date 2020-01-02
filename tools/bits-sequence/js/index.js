$(document).ready(function(){
    $('.entry').val('');

    let input=$('#input'), bits_sequence=$('#bits_sequence'),
        bfpn=$('#bfpn');

    input.on('input', function(){
        let allowed=this.value.replace(/[^0-9\-\.]/,'');
        
        $(this).val(allowed);

        let prec_significand=27, prec_exp=7;

        if($('#type').val()=='64'){
            prec_significand=56;
            prec_exp=10;
        }
        
        let binary_number=decimal_to_binary($(this).val(),prec_significand),
            unsigned_exponent=127+parseInt(normalize(binary_number).exp)+'';
            
        let significand=normalize(binary_number).n,
            exponent=decimal_to_binary(unsigned_exponent, 9), sign=normalize(binary_number).sign;

        significand=significand.replace(/0+1\D/,'1.');
        
        for(i=significand.length-1;i<prec_significand-3;i++){
            significand+='0';
        }

        significand=significand.substring(0,prec_significand-2);

        for(i=exponent.length-1;i<prec_exp;i++){
            exponent='0'+exponent;
        }


        bits_sequence.text(sign + ' ' + exponent + ' ' + significand);

        bfpn.html(normalize(binary_number).n.replace(/0+1\D/,'1.') + 'x2<sup>' + normalize(binary_number).exp + '</sup>');
    });

    function normalize(n){
        let sign=n[0]=='-' ? '1' : '0', num=n.replace(/[-]/,''),
            point_pos=num.search(/[.]/)==-1 ? num.length : num.search(/[.]/),
            pos=parseFloat(num)<1 ? 0 : -1;

        if(num.length==0 || parseFloat(num)==0){
            return {n:'0.0', exp:0, sign: sign}
        }

        for(i=0;i<num.length;i++){
            if(num[i]==1){
                pos=i-pos;

                break;
            }
        }

        num=num.replace(/[.]/,'');

        let output = ''+[num.slice(0, pos), '.', num.slice(pos)].join('');

        if(output=='1.') output=output+'0';

        return {n: output, exp: point_pos - pos, sign: sign}
    }

    function decimal_to_binary(n, type){
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

            for(i=0;i<type;i++){
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

    function reverse(s){
        return s.split("").reverse().join("");
    }
});