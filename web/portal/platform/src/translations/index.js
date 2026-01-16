import IvozUiCa from '@irontec/ivoz-ui/translations/ca';
import IvozUiEn from '@irontec/ivoz-ui/translations/en';
import IvozUiEs from '@irontec/ivoz-ui/translations/es';
import IvozUiEu from '@irontec/ivoz-ui/translations/eu';
import IvozUiIt from '@irontec/ivoz-ui/translations/it';

import ca from './ca';
import en from './en';
import es from './es';
import eu from './eu';
import it from './it';

const translations = {
  es: {
    translation: {
      ...IvozUiEs,
      ...es,
    },
  },
  en: {
    translation: {
      ...IvozUiEn,
      ...en,
    },
  },
  ca: {
    translation: {
      ...IvozUiCa,
      ...ca,
    },
  },
  it: {
    translation: {
      ...IvozUiIt,
      ...it,
    },
  },
  eu: {
    translation: {
      ...IvozUiEu,
      ...eu,
    },
  },
};

export default translations;
