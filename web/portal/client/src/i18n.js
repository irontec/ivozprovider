import i18n from 'i18next';
import LanguageDetector from 'i18next-browser-languagedetector';
import sprintf from 'i18next-sprintf-postprocessor';
import { initReactI18next } from 'react-i18next';
import translations from 'translations/index';

const fallbackLng = 'en-US';

i18n
  // detect user language
  // learn more: https://github.com/i18next/i18next-browser-languageDetector
  .use(LanguageDetector)
  // pass the i18n instance to react-i18next.
  .use(initReactI18next)
  //sprintf postprocessor: https://github.com/i18next/i18next-sprintf-postProcessor
  .use(sprintf)
  // init i18next
  // for all options read: https://www.i18next.com/overview/configuration-options
  .init({
    debug: false,
    fallbackLng,
    interpolation: {
      escapeValue: false, // not needed for react as it escapes by default
    },
    overloadTranslationOptionHandler: sprintf.overloadTranslationOptionHandler,
    resources: {
      ...translations,
    },
    detection: {
      convertDetectedLanguage: (lng) => {
        const availableLangKeys = Object.keys(translations);
        const currentLangKey = lng.substring(0, 2).toLocaleLowerCase();
        if (!availableLangKeys.includes(currentLangKey)) {
          return fallbackLng;
        }

        return lng;
      },
    },
  });

export default i18n;
