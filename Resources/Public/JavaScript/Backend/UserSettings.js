// namespace: TYPO3/CMS/CfGoogleAuthenticator/Backend/UserSettings

define(
    ['jquery'],
    function ($) {

        $(function () {
            let selectors = {
                    iFrame: 'body',
                    inputEnable: '[data-formengine-input-name$="[tx_cfgoogleauthenticator_enabled]"],[name$="[tx_cfgoogleauthenticator_enabled]"]',
                    inputSecret: '[name$="[tx_cfgoogleauthenticator_secret]"]',
                    inputOtp: '[name$="[tx_cfgoogleauthenticator_otp]"]',
                    formSection: '.form-section'
                },
                $iFrame = $(selectors.iFrame),
                $inputEnable = $iFrame.find(selectors.inputEnable);

            $iFrame.on(
                'click',
                selectors.inputEnable,
                update
            );

            function update() {
                let isEnabled = $inputEnable.prop('checked');

                if (isEnabled === true) {
                    $iFrame.find(selectors.inputSecret).closest(selectors.formSection).slideDown();
                } else {
                    $iFrame.find(selectors.inputSecret).closest(selectors.formSection).slideUp();
                }
            }

            update();
        });

    }
);
