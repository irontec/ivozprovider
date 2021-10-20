import { PropertySpec } from "lib/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "lib/services/entity/EntityService";

type QueuePropertyList<T> = {
    'name'?: T,
    'maxWaitTime'?: T,
    'timeoutLocution'?: T,
    'timeoutTargetType'?: T,
    'timeoutNumberCountry'?: T,
    'timeoutNumberValue'?: T,
    'timeoutExtension'?: T,
    'timeoutVoiceMailUser'?: T,
    'maxlen'?: T,
    'fullLocution'?: T,
    'fullTargetType'?: T,
    'fullNumberCountry'?: T,
    'fullNumberValue'?: T,
    'fullExtension'?: T,
    'fullVoiceMailUser'?: T,
    'periodicAnnounceLocution'?: T,
    'periodicAnnounceFrequency'?: T,
    'memberCallRest'?: T,
    'memberCallTimeout'?: T,
    'strategy'?: T,
    'weight'?: T,
    'preventMissedCalls'?: T,
};

export type QueueProperties = QueuePropertyList<Partial<PropertySpec>>;
export type QueuePropertiesList = Array<QueuePropertyList<EntityValue | EntityValues>>;