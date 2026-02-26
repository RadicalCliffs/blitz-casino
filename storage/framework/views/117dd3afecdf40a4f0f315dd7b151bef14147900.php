<div class="wrapper">
    <div style="margin-top: 20px;" class="faq d-flex flex-column">
        <div class="faq__item">
            <div class="faq__item-heading d-flex align-center">
                <b class="faq__item-question d-flex align-center justify-center">?</b>
                <span>What is Blitz Casino?</span>
            </div>
            <div class="faq__item-body">
                <p>Blitz Casino is an instant gaming platform with provably fair games.</p>
            </div>
        </div>
        <div class="faq__item">
            <div class="faq__item-heading d-flex align-center">
                <b class="faq__item-question d-flex align-center justify-center">?</b>
                <span>How does the referral system work?</span>
            </div>
            <div class="faq__item-body">
                <p>You receive +10% from every deposit made by your referral. <br>
                If you collect a certain number of referrals, you can use the free wheel spin and get a bonus.</p>
            </div>
        </div>
        <div class="faq__item">
            <div class="faq__item-heading d-flex align-center">
                <b class="faq__item-question d-flex align-center justify-center">?</b>
                <span>How long does withdrawal take?</span>
            </div>
            <div class="faq__item-body">
                <p>The withdrawal process takes from 1 minute to 24 hours from the moment of creating the request. <br>
                Sometimes it may be delayed up to 2 days.</p>
            </div>
        </div>
        <div class="faq__item">
            <div class="faq__item-heading d-flex align-center">
                <b class="faq__item-question d-flex align-center justify-center">?</b>
                <span>What is the minimum withdrawal amount?</span>
            </div>
            <div class="faq__item-body">
                <p>The minimum withdrawal amount is $100.</p>
            </div>
        </div>
        <div class="faq__item">
            <div class="faq__item-heading d-flex align-center">
                <b class="faq__item-question d-flex align-center justify-center">?</b>
                <span>My withdrawal was rejected, what should I do?</span>
            </div>
            <div class="faq__item-body">
                <p>Most likely you entered incorrect details, or violated our rules.</p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
   $('.faq__item .faq__item-heading').click(function(e){
    e.preventDefault();
    if($(this).parent().hasClass('faq__item--opened')) {
        $(this).parent().removeClass('faq__item--opened').css({'max-height':'60px'});
    } else {
        $('.faq__item.faq__item--opened').removeClass('faq__item--opened').css({'max-height':'60px'});
        $(this).parent().addClass('faq__item--opened').css({'max-height': $(this).parent()[0].scrollHeight});
    }
});
</script><?php /**PATH C:\Users\maxmi\OneDrive\Documents\Downloads\GoldenX-CASINO-SITE-main\GoldenX-CASINO-SITE-main\resources\views/faq.blade.php ENDPATH**/ ?>