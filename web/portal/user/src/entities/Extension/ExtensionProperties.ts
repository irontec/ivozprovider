import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type ExtensionPropertyList<T> = {
  number?: T;
  routeType?: T;
  numberValue?: T;
  friendValue?: T;
  id?: T;
  user?: T;
  numberCountry?: T;
  voicemail?: T;
};

export type ExtensionProperties = ExtensionPropertyList<Partial<PropertySpec>>;
export type ExtensionPropertiesList = Array<
  ExtensionPropertyList<EntityValue | EntityValues>
>;
