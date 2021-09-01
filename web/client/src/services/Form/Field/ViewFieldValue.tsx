import { PropertySpec, ScalarProperty } from "services/Api/ParsedApiSpecInterface";
import CustomComponent from "./CustomComponent";

interface ViewValueProps {
    columnName: string,
    property: PropertySpec,
    values: any,
}

const ViewFieldValue = (props: ViewValueProps) => {
    let { property, columnName } = props;

    if (!(property as ScalarProperty).component) {

        const component = (innerProps: any) => {

            let val = innerProps[columnName];
            if (typeof val === 'object') {
                val = JSON.stringify(val);
            } else if ((props.property as ScalarProperty).enum) {
                const enumValues: any = (props.property as ScalarProperty).enum;
                val = enumValues[val];
            }

            return (<span>{val}</span>);
        };

        property = {
            ...property,
            component: (component as any)
        }
    }

    return (
        <CustomComponent {...props} property={property} columnName={columnName} />
    );
}

export default ViewFieldValue;