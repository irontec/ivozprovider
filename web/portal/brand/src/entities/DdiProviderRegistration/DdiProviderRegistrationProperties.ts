import { PropertySpec } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import {
  EntityValue,
  EntityValues,
} from '@irontec/ivoz-ui/services/entity/EntityService';

export type DdiProviderRegistrationPropertyList<T> = {
  username?: T;
  domain?: T;
  realm?: T;
  authUsername?: T;
  authPassword?: T;
  authProxy?: T;
  expires?: T;
  multiDdi?: T;
  contactUsername?: T;
  id?: T;
  ddiProvider?: T;
  status?: T;
  statusIcon?: T;
};

export type DdiProviderRegistrationProperties =
  DdiProviderRegistrationPropertyList<Partial<PropertySpec>>;
export type DdiProviderRegistrationPropertiesList = Array<
  DdiProviderRegistrationPropertyList<EntityValue | EntityValues>
>;
