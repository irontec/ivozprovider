import { ListDecorator, ScalarProperty } from '@irontec/ivoz-ui';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { useStoreState } from 'store';
import { CallForwardSettingPropertyList } from '../CallForwardSettingProperties';

type CallForwardTypeValues = CallForwardSettingPropertyList<string>;
type CallForwardTypeProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<CallForwardTypeValues>
>;

const CallForwardType: CallForwardTypeProps = (props): JSX.Element | null => {
  const { _context, _columnName, property, values, formFieldFactory } = props;
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  if (_context === 'read' || !formFieldFactory) {
    return (
      <ListDecorator
        field={_columnName}
        row={values}
        property={property}
        ignoreCustomComponent={true}
      />
    );
  }

  const { choices, readOnly } = props;
  const modifiedProperty = { ...property } as ScalarProperty;
  delete modifiedProperty.component;

  if (!aboutMe) {
    return formFieldFactory.getInputField(
      _columnName,
      modifiedProperty,
      choices,
      readOnly
    );
  }

  const enumValues = {
    ...modifiedProperty.enum,
  };

  if (aboutMe?.retail) {
    delete enumValues.noAnswer;
    delete enumValues.busy;
  }

  modifiedProperty.enum = enumValues;

  return formFieldFactory.getInputField(
    _columnName,
    modifiedProperty,
    choices,
    readOnly
  );
};

export default CallForwardType;
