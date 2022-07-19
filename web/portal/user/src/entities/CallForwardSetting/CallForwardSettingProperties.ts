import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type CallForwardSettingPropertyList<T> = {
  callTypeFilter?: T;
  callForwardType?: T;
  targetType?: T;
  numberValue?: T;
  noAnswerTimeout?: T;
  enabled?: T;
  id?: T;
  user?: T;
  extension?: T;
  voicemail?: T;
  numberCountry?: T;
};

export type CallForwardSettingProperties = CallForwardSettingPropertyList<
  Partial<PropertySpec>
>;
export type CallForwardSettingPropertiesList = Array<
  CallForwardSettingPropertyList<EntityValue | EntityValues>
>;
