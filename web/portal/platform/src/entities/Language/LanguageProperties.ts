import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type LanguagePropertyList<T> = {
  iden?: T;
  id?: T;
  name?: T;
};

export type LanguageProperties = LanguagePropertyList<Partial<PropertySpec>>;
export type LanguagePropertiesList = Array<
  LanguagePropertyList<EntityValue | EntityValues>
>;
