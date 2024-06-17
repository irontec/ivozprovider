import { PropertySpec } from '@irontec-voip/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec-voip/ivoz-ui/services/entity/EntityService';

export type FaxPropertyList<T> = {
  name?: T;
  email?: T;
  sendByEmail?: T;
  outgoingDdi?: T;
  relUserIds?: T;
};

export type FaxProperties = FaxPropertyList<Partial<PropertySpec>>;

export type FaxPropertiesList = Array<
  FaxPropertyList<EntityValue | EntityValues>
>;
