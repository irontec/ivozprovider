import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { EntityValue, EntityValues } from '@irontec/ivoz-ui/services/entity/EntityService';

export type IvrEntryPropertyList<T> = {
  'ivr'?: T,
  'entry'?: T,
  'welcomeLocution'?: T,
  'displayName'?: T,
  'routeType'?: T,
  'numberCountry'?: T,
  'numberValue'?: T,
  'extension'?: T,
  'voicemail'?: T,
  'conditionalRoute'?: T,
  'target'?: T,
};

export type IvrEntryProperties = IvrEntryPropertyList<Partial<PropertySpec>>;

export type IvrEntryPropertiesList = Array<IvrEntryPropertyList<EntityValue | EntityValues>>;