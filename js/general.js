let mask_load={
    mask: document.createElement('div'),
	render: function(){
		setTimeout(function(){
            mask_load.mask.classList.add("mask_load");
            
            document.body.insertBefore(mask_load.mask, document.body.firstChild);
		},300);
	},
	hide: function(){
		setTimeout(function(){
			document.body.removeChild(mask_load.mask);
		},300);
	}
},

mask_menu={
    mask: document.createElement('div'),
    render: function(){
        this.mask.classList.add('mask_menu');

        document.body.insertBefore(this.mask, document.body.firstChild);
    },
    hide: function(){
        document.body.removeChild(this.mask);
    }
}