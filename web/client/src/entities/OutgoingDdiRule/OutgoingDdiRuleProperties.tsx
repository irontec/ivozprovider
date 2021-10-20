import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

type OutgoingDdiRulePropertyList<T> = {
    'attr'?: T,
    'name'?: T,
    'defaultAction'?: T,
    'forcedDdi'?: T,
};

export type OutgoingDdiRuleProperties = OutgoingDdiRulePropertyList<Partial<PropertySpec>>;
export type OutgoingDdiRulePropertiesList = Array<OutgoingDdiRulePropertyList<EntityValue | EntityValues>>;