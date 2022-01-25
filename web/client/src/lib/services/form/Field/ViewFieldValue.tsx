import { isPropertyFk, PropertySpec, ScalarProperty } from "lib/services/api/ParsedApiSpecInterface";
import EntityService from "lib/services/entity/EntityService";
import { CustomComponentWrapper, PropertyCustomFunctionComponent } from "./CustomComponentWrapper";
import FileUploader from "./FileUploader";

interface ViewValueProps {
    columnName: string,
    property: PropertySpec,
    entityService: EntityService,
    values: any,
}

const ViewFieldValue = (props: ViewValueProps): JSX.Element => {
    const { columnName, values, entityService } = props;
    let { property } = props;

    const noComponent = !(property as ScalarProperty).component;

    if (noComponent && isPropertyFk(property) && property.type === 'file') {

        const downloadModel = property.$ref.split('/').pop();
        const downloadAction = entityService.getItemByModel(downloadModel ?? '');
        const paths = downloadAction?.paths || [];
        const downloadPath = paths.length
            ? paths.pop().replace('{id}', values.id)
            : null;

        return (
            <FileUploader
                property={property}
                _columnName={columnName}
                disabled={true}
                values={values}
                changeHandler={() => { return; }}
                onBlur={() => { return; }}
                downloadPath={downloadPath}
                hasChanged={false}
            />
        );

    } else if (noComponent) {

        const component: PropertyCustomFunctionComponent<any> = (props: any) => {

            const { values, property} = props;
            let val = values[columnName];
            if (val === null) {
                val = '';
            } else if (typeof val === 'object') {
                val = JSON.stringify(val);
            } else if ((property as ScalarProperty).enum) {
                const enumValues: any = (property as ScalarProperty).enum;
                val = enumValues[val];
            }

            const prefix = property?.prefix || '';

            return (<span>{prefix}{val}</span>);
        };

        property = {
            ...property,
            component
        };
    }

    const PropertyComponent = (property as ScalarProperty).component as React.FunctionComponent<any>;


    return (
        <CustomComponentWrapper property={property} hasChanged={false} disabled={true}>
            <PropertyComponent _context={'read'} _columnName={columnName} property={property} values={values} />
        </CustomComponentWrapper>
    );
}

export default ViewFieldValue;