import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type HuntGroupPropertyList<T> = {
  id?: T;
  name?: T;
  description?: T;
  strategy?: T;
  preventMissedCalls?: T;
  allowCallForwards?: T;
  ringAllTimeout?: T;
  noAnswerTargetType?: T;
  noAnswerLocution?: T;
  noAnswerNumberCountry?: T;
  noAnswerNumberValue?: T;
  noAnswerExtension?: T;
  noAnswerVoicemail?: T;
};

export type HuntGroupProperties = HuntGroupPropertyList<Partial<PropertySpec>>;

export type HuntGroupPropertiesList = Array<
  HuntGroupPropertyList<EntityValue | EntityValues>
>;
