import { DropdownChoices } from '@irontec/ivoz-ui';
import defaultEntityBehavior from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { getI18n } from 'react-i18next';
import store from 'store';

const LanguageSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const Language = entities.Language;

  return defaultEntityBehavior.fetchFks(
    Language.path,
    ['id', 'name'],
    (data) => {
      const options: DropdownChoices = {};
      const language = getI18n().language.substring(0, 2);
      for (const item of data) {
        options[item.id] = item.name[language];
      }

      callback(options);
    },
    cancelToken
  );
};

export default LanguageSelectOptions;
