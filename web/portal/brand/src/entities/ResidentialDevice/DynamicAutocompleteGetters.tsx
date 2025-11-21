import { autoSelectOptionHandlers } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import {
  DynamicAutocompleteGetterType,
  DynamicAutocompleteGetterTypeArgs,
  SelectOptionsType,
} from '@irontec/ivoz-ui/entities/EntityInterface';

import ResidentialSelectOptions from '../Company/SelectOptions/ResidentialSelectOptions';

const dynamicAutocompleteGetters: DynamicAutocompleteGetterType = async (
  props: DynamicAutocompleteGetterTypeArgs
): Promise<Record<string, SelectOptionsType>> => {
  const options = await autoSelectOptionHandlers({
    entityService: props.entityService,
    skip: ['Company'],
  });

  options['Company'] = ResidentialSelectOptions;

  return options;
};

export default dynamicAutocompleteGetters;
