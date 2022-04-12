import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type LocutionPropertyList<T> = {
  'name'?: T,
  'originalFile'?: T,
  'recordingExtension'?: T,
  'status'?: T,
};

export type LocutionProperties = LocutionPropertyList<Partial<PropertySpec>>;
export type LocutionPropertiesList = Array<LocutionPropertyList<EntityValue | EntityValues>>;