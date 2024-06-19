import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type FeaturePropertyList<T> = {
  iden?: T;
  id?: T;
  name?: T;
};

export type FeatureProperties = FeaturePropertyList<Partial<PropertySpec>>;
export type FeaturePropertiesList = Array<
  FeaturePropertyList<EntityValue | EntityValues>
>;
