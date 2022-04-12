import { ListDecorator, ScalarProperty } from '@irontec/ivoz-ui';
import {
    PropertyCustomFunctionComponent,
    PropertyCustomFunctionComponentProps
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { useStoreState } from 'store';
import { DdiPropertyList } from '../DdiProperties';

type RouteTypeValues = DdiPropertyList<string>;
type RouteTypeProps = PropertyCustomFunctionComponent<PropertyCustomFunctionComponentProps<RouteTypeValues>>;

const RouteType: RouteTypeProps = (props): JSX.Element | null => {

    const { _context, _columnName, property, values, formFieldFactory } = props;
    const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

    if (_context === 'read' || !formFieldFactory) {
        return (
            <ListDecorator field={_columnName} row={values} property={property} ignoreCustomComponent={true} />
        );
    }

    const { choices, readOnly } = props;

    const modifiedProperty = { ...property } as ScalarProperty;
    delete modifiedProperty.component;

    const enumValues = {
        ...modifiedProperty.enum
    };

    if (!aboutMe?.pbx) {
        delete enumValues.user;
        delete enumValues.ivr;
        delete enumValues.huntGroup;
        delete enumValues.conditional;
    }

    if (!aboutMe?.residential) {
        delete enumValues.residentialDevice;
    }

    if (!aboutMe?.retail) {
        delete enumValues.retail;
    }

    modifiedProperty.enum = enumValues;

    return formFieldFactory.getInputField(
        _columnName,
        modifiedProperty,
        choices,
        readOnly
    );
}

export default RouteType;