import { PropertyCustomComponent, PropertySpec, ScalarProperty } from "lib/services/api/ParsedApiSpecInterface";
import CustomComponentWrapper from "./CustomComponentWrapper";

interface ViewValueProps {
    columnName: string,
    property: PropertySpec,
    values: any,
}

const ViewFieldValue = (props: ViewValueProps) => {
    let { property, columnName, values } = props;

    if (!(property as ScalarProperty).component) {

        const component:PropertyCustomComponent<any> = (innerProps: any) => {

            let val = innerProps[columnName];
            if (typeof val === 'object') {
                val = JSON.stringify(val);
            } else if ((props.property as ScalarProperty).enum) {
                const enumValues: any = (props.property as ScalarProperty).enum;
                val = enumValues[val];
            }

            const prefix = property?.prefix || '';

            return (<span>{prefix}{val}</span>);
        };

        property = {
            ...property,
            component
        }
    }

    const PropertyComponent = (property as ScalarProperty).component as PropertyCustomComponent<any>;

    return (
        <CustomComponentWrapper property={property}>
            <PropertyComponent _context={'read'} _columnName={columnName} {...values} />
        </CustomComponentWrapper>
    );
}

export default ViewFieldValue;