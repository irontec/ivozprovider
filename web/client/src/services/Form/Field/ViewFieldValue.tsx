import { PropertySpec, ScalarProperty } from "services/Api/ParsedApiSpecInterface";
import CustomComponent from "./CustomComponent";

interface ViewValueProps {
    columnName: string,
    property: PropertySpec,
    values: any,
}

const ViewFieldValue = (props:ViewValueProps) =>
{
    let {property, columnName} = props;

    if (!(property as ScalarProperty).component) {
        const component = (innerProps:any) => {
            return (<span>{innerProps[columnName]}</span>)
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