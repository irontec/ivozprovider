import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type CallForwardSettingPropertyList<T> = {
  'user'?: T,
  'residentialDevice'?: T,
  'retailAccount'?: T,
  'friend'?: T,
  'ddi'?: T,
  'cfwToRetailAccount'?: T,
  'callTypeFilter'?: T,
  'callForwardType'?: T,
  'targetType'?: T,
  'numberCountry'?: T,
  'numberValue'?: T,
  'extension'?: T,
  'voicemail'?: T,
  'noAnswerTimeout'?: T,
  'targetTypeValue'?: T,
  'enabled'?: T,
};

export type CallForwardSettingProperties = CallForwardSettingPropertyList<Partial<PropertySpec>>;
export type CallForwardSettingPropertiesList = Array<CallForwardSettingPropertyList<EntityValue | EntityValues>>;