import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type WebPortalPropertyList<T> = {
  url?: T;
  color?: T;
  urlType?: T;
  name?: T;
  id?: T;
  logo?: T;
};

export type WebPortalProperties = WebPortalPropertyList<Partial<PropertySpec>>;
export type WebPortalPropertiesList = Array<
  WebPortalPropertyList<EntityValue | EntityValues>
>;
