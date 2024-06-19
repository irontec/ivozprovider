import IvozUiCa from '@irontec/ivoz-ui/translations/ca';
import IvozUiEn from '@irontec/ivoz-ui/translations/en';
import IvozUiEs from '@irontec/ivoz-ui/translations/es';
import IvozUiIt from '@irontec/ivoz-ui/translations/it';

import ca from './ca';
import en from './en';
import es from './es';
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
};

export default translations;
