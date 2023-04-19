<div class="row">
    <livewire:styles />
    <livewire:scripts />
    <div>
        <livewire:admin.support/>
    </div>
</div>
<script>
    window.addEventListener('skroll', event => {
        var block = document.getElementById("block_chat");
        block.scrollTop = block.scrollHeight;
    })
</script>
<style>
    .input-row__input.basic-textarea{
        padding-left: 30px;
        padding-top: 10px;
    }
    #message_chat{
        padding-left:20px;
        padding-top:5px;
    }
    .chat_content.selected{
        background-color: aliceblue!important;
    }
    textarea:focus{
        border: 0px solid black!important;

    }
    .support-chat__item.support .support-chat__text-block {
        background: #E5F2FF;
        color: #69B4FF;
    }
    .support-chat__item.support{
        -webkit-box-orient: horizontal;
        -webkit-box-direction: reverse;
        -ms-flex-direction: row-reverse;
        flex-direction: row-reverse;
    }
    .support-chat{
        float: left;
        width: 100%;
        padding-bottom: 20px;
        height: auto;
        max-height: calc(100vh - 325px);
        min-height: 300px;
        overflow-y: auto;
        margin-bottom: 30px;
        padding-right: 200px;
    }
    .support-chat__item{
        width: 100%;
        margin-bottom: 30px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
        -webkit-box-pack: end;
        -ms-flex-pack: end;
        justify-content: flex-end;
    }
    .support-chat__text-block{
        width: auto;
        max-width: calc(100% - 200px);
        background: #FFFFFF;
        border: 1px solid #69B4FF;
        -webkit-box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
        box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 30px;
        padding: 20px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-align: start;
        -ms-flex-align: start;
        align-items: flex-start;
    }
    .message-field{
        float: left;
        width: 100%;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: justify;
        -ms-flex-pack: justify;
        justify-content: space-between;
    }
    .message-field .input-row__input {
        width: calc(100% - 80px);
        margin-bottom: 0;
        border: 1px solid #69B4FF;
        -webkit-box-shadow: inset 4px 4px 4px rgba(0, 0, 0, 0.25);
        box-shadow: inset 4px 4px 4px rgba(0, 0, 0, 0.25);
        border-radius: 30px;
    }
    .message-field__button {
        width: 55px;
        height: 55px;
        border: none;
        padding: 0;
        border-radius: 50%;
        overflow: hidden;
        background: #69B4FF;
        -webkit-box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
        position: relative;
        -webkit-transition: ease-in-out 300ms;
        -moz-transition: ease-in-out 300ms;
        -ms-transition: ease-in-out 300ms;
        -o-transition: ease-in-out 300ms;
        transition: ease-in-out 300ms;
    }
    .message-field__button:before {
        content: '';
        display: block;
        float: left;
        width: 24px;
        height: 30px;
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translate(-50%, -50%) rotate(180deg);
        -ms-transform: translate(-50%, -50%) rotate(180deg);
        transform: translate(-50%, -50%) rotate(180deg);
        background: url(../img/arrow-down.svg) no-repeat;
        background-size: 100% 100%;
        -webkit-filter: brightness(0) saturate(100%) invert(100%) sepia(100%) saturate(0%) hue-rotate(288deg) brightness(102%) contrast(102%);
        filter: brightness(0) saturate(100%) invert(100%) sepia(100%) saturate(0%) hue-rotate(288deg) brightness(102%) contrast(102%);
    }
    p.support-chat__text{
        margin:0px!important;
    }
    .chat_content{
        cursor: pointer!important;
    }
</style>
