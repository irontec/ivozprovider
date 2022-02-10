import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

export type QueueMemberPropertyList<T> = {
    'queue'?: T,
    'user'?: T,
    'penalty'?: T,

};

export type QueueMemberProperties = QueueMemberPropertyList<Partial<PropertySpec>>;
export type QueueMemberPropertiesList = Array<QueueMemberPropertyList<EntityValue | EntityValues>>;