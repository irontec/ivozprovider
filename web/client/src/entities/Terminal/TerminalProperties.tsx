import { PropertySpec } from "@irontec/ivoz-ui/services/api/ParsedApiSpecInterface";
import { EntityValue, EntityValues } from "@irontec/ivoz-ui/services/entity/EntityService";

export type TerminalPropertyList<T> = {
    'name'?: T,
    'mac'?: T,
    'lastProvisionDate'?: T,
    'disallow'?: T,
    'allowAudio'?: T,
    'allowVideo'?: T,
    'directMediaMethod'?: T,
    'password'?: T,
    't38Passthrough'?: T,
    'rtpEncryption'?: T,
    'terminalModel'?: T,
    'domain'?: T,
};

export type TerminalProperties = TerminalPropertyList<Partial<PropertySpec>>;
export type TerminalPropertiesList = Array<TerminalPropertyList<EntityValue | EntityValues>>;