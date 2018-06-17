// namespace: TYPO3/CMS/CfGoogleAuthenticator/Backend/UserSettings

define(
    ['jquery'],
    function($) {

        $(function() {
            var selectors = {
                    iFrame: 'body',
                    inputEnable: '[data-formengine-input-name$="[tx_cfgoogleauthenticator_enable]"]',
                    inputSecret: '[name$="[tx_cfgoogleauthenticator_secret]"]',
                    inputOtp: '[name$="[tx_cfgoogleauthenticator_otp]"]',
                    formSection: '.form-section'
                },
                $iFrame = $(selectors.iFrame),
                $inputEnable = $iFrame.find(selectors.inputEnable);

            $iFrame.on(
                'click',
                selectors.inputEnable,
                function(event) {
                    update();
                }
            );

            function update() {
                var isEnabled = $inputEnable.prop('checked');

                if(isEnabled === true) {
                    $iFrame.find(selectors.inputSecret).closest(selectors.formSection).slideDown();
                } else {
                    $iFrame.find(selectors.inputSecret).closest(selectors.formSection).slideUp();
                }
            }

            update();
        });
    }
);