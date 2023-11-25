$(function(){

	$("#main-form").validate({
		ignore: ":hidden",
		rules: {
			address: {
				required: true
			},
			// unit: {
			// 	required: true,
			// },
			password:{
					required: true,
			},
			street_no: {
				required: true,
			},
			city:{
				required: true,
			},
			state:{
				required: true,
			},
			zip:{
				required: true,
			},
			country:{
				required: true,
			},
            service_requested:{
				required: true,
			},
            service_preference:{
				required: true,
			},
            boxes:{
				required: true,
			},
			container:{
				required: true,
			},
            firstname:{
				required: true,
			},
			lastname:{
				required: true,
			},
			email:{
				required: true,
				email:true
			},
			phone:{
				required: true,
			},
			cmb_order_item:{
				required: true,
			},

			hf_grandtotal:{
				required: true,
			},
			hf_base_price:{
				required: true,
			},
			hf_subtotal:{
				required: true,
			},


		},
		messages: {
			address: {
				required:'Address is required'
			},
			// unit: {
			// 	required: 'Unit is required',
			// },
			password: {
				required: 'Password is required',
			},
			city:{
				required: 'City is required',
			},
			state:{
				required: 'State/Province is Required',
			},
			zip:{
				required: 'Post code is required',
			},
			country:{
				required: 'Required',
			},
            service_requested:{
				required: 'Service requested is required',
			},
            service_preference:{
				required: 'Service type is required',
			},
            boxes:{
				required: 'Quantity is required',
			},
			container:{
				required: 'Container type is required',
			},
			firstname:{
				required: 'First name is required',
			},
			lastname:{
				required: 'Last name is required',
			},
			email:{
				required: 'Email is required',
				email:'Invalid Email',
			},
			phone:{
				required: 'Phone number is required',
			},
            street_no: {
                required: 'Street No is required',
            },
						cmb_order_item:{
							required: 'Order Item is required',
						},
						hf_grandtotal:{
							required: 'Order Item is required',
						},
						hf_subtotal:{
							required: 'Order Item is required',
						},
						hf_base_price:{
							required: 'Order Item is required',
						},


		},
		success: function(label) {
			label.detach();
		}
	});
});
