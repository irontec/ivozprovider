import i18n from 'i18next';
import LanguageDetector from 'i18next-browser-languagedetector';
import sprintf from 'i18next-sprintf-postprocessor';
import { initReactI18next } from 'react-i18next';
import translations from 'translations/index';

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
    fallbackLng: 'en',
    interpolation: {
      escapeValue: false, // not needed for react as it escapes by default
    },
    overloadTranslationOptionHandler: sprintf.overloadTranslationOptionHandler,
    resources: {
      ...translations,
    },
  });

export default i18n;
