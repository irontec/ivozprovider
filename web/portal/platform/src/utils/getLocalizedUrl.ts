import { getI18n } from 'react-i18next';

export const getLocalizedUrl = (pathTemplate: string): string => {
  const i18nInstance = getI18n();
  const language = i18nInstance?.language?.substring(0, 2) || 'en';

  return pathTemplate.replace('${language}', language);
};
