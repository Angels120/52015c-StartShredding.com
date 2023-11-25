CKEDITOR.plugins.add('newplugin',
    {
        //icons: 'abbr',
        init: function (editor) {

            var pluginName = 'newplugin';
            editor.ui.addButton('Newplugin',
                {
                    label: 'Find Synonym',
                    command: 'Find_Synonym',
                    loading: 'loading...',
                    icon: CKEDITOR.plugins.getPath('newplugin') + 'synonym.png'
                });
            /*editor.ui.addButton( 'Abbr', {
                label: 'Insert Abbreviation',
                command: 'abbr',
                toolbar: 'insert'
            });*/
            var cmd = editor.addCommand('Find_Synonym', { exec: FindSynonym });




            /*editor.getSelection().lock();
            var text = editor.getSelection().getSelectedText();
            alert( text );
*/
            editor.on('afterCommandExec', handleAfterCommandExec/*function(event){
                var commandName = event.data.name;
                if (commandName == 'Find_Synonym'){
                    alert("Find Synonym triggered (backend coding in progress)");
                }
            }*/);


        }

    });

function FindSynonym(e) {
    /*var sel = e.getSelection().getSelectedText();
    //var sel = e;
    console.log(sel);
    console.log(e);*/
    //window.open('/Default.aspx', 'Find Synonym', 'width=800,height=700,scrollbars=no,scrolling=no,location=no,toolbar=no');
}

function handleAfterCommandExec(event){

    var selectedContent = '';


    var selections = CKEDITOR.instances['contents'].getSelection();
    if (selections.getType() == CKEDITOR.SELECTION_ELEMENT) {
        selectedContent = selections.getSelectedElement().$.outerHTML;
    } else if (selections.getType() == CKEDITOR.SELECTION_TEXT) {
        if (CKEDITOR.env.ie) {
            selections.unlock(true);
            selectedContent = selections.getNative().createRange().text;
        } else {
            selectedContent = selections.getNative();
            //console.log("The selectedContent is: " + selectedContent);
        }
    }

    var commandName = event.data.name;
    if (commandName == 'Find_Synonym'){

        $("#loading").show();

        //var getUrl = window.location;
        //var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

        //var url = window.location.protocol + "//" + window.location.host + "/new_email_builder/find-synonyms?word=example";
        $.get(base_url+"/find-synonyms?word="+selectedContent, '', function(response){

            var newWord = '';
            if(response=='0'){
                $(".place_synonyms_here").html("<p>No synonym found!</p>");
            }else{
                $(".place_synonyms_here").html(response);
            }
            $("#place_synonyms_here").modal("show");
            $("#loading").hide();
            //console.log(response);

            $(".replace_now").on('click', function(){


                $( $("input[name='replace_synonym']") ).each( function( index, element ){
                    if($(this).is(":checked")){
                        //console.log( $( this ).val() );
                        newWord = $(this).val();
                    }
                });


                //get the current selection
                var editor = CKEDITOR.instances['contents'];
                var selection2 = editor.getSelection();
                var selectedElement = selection2.getSelectedElement();

                //if nothing is selected then create a new paragraf element
                if (!selectedElement)
                    selectedElement = new CKEDITOR.dom.element('span');

                //Insert your content into the element
                selectedElement.setHtml(newWord+" ");

                //If needed, insert your element into the dom (it will be inserted into the current position)
                editor.insertElement(selectedElement);

                //and then just select it
                selection2.selectElement(selectedElement);

                $("#place_synonyms_here").modal("hide");

            });

        });



    }
}
