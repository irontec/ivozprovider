import { DropdownChoices } from '@irontec/ivoz-ui';
import { SelectOptionsType } from '@irontec/ivoz-ui/entities/EntityInterface';
import { getI18n } from 'react-i18next';
import store from 'store';

const TransformationRuleSetSelectOptions: SelectOptionsType = ({
  callback,
  cancelToken,
}): Promise<unknown> => {
  const entities = store.getState().entities.entities;
  const TransformationRuleSet = entities.TransformationRuleSet;
  const language = getI18n().language.substring(0, 2);

  const getAction = store.getActions().api.get;
  return getAction({
    path: TransformationRuleSet.path + `?_order[name.${[language]}]=ASC`,
    params: {
      _pagination: false,
      _itemsPerPage: 1000,
      _properties: ['id', 'name'],
    },
    successCallback: async (data: any) => {
      const options: DropdownChoices = [];
      for (const item of data) {
        options.push({ id: item.id, label: item.name[language] });
      }

      callback(options);
    },
    cancelToken,
  });
};

export default TransformationRuleSetSelectOptions;
