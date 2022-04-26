import { RouteComponentProps } from 'react-router-dom';
import { ListDecorator, ScalarProperty } from '@irontec/ivoz-ui';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { useStoreState } from 'store';
import { CallForwardSettingPropertyList } from '../CallForwardSettingProperties';

type TargetTypeValues = CallForwardSettingPropertyList<string>;
type TargetTypeCustomComponent = PropertyCustomFunctionComponent<RouteComponentProps & PropertyCustomFunctionComponentProps<TargetTypeValues>>;

const TargetType: TargetTypeCustomComponent = (props): JSX.Element | null => {

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

  if (!aboutMe) {
    return formFieldFactory.getInputField(
      _columnName,
      modifiedProperty,
      choices,
      readOnly,
    );
  }

  const enumValues = {
    ...modifiedProperty.enum,
  };

  if (!aboutMe.vpbx && !aboutMe.residential) {
    delete enumValues.voicemail;
  }

  if (!aboutMe?.vpbx) {
    delete enumValues.extension;
  }

  if (!aboutMe?.retail) {
    delete enumValues.retail;
  }

  modifiedProperty.enum = enumValues;

  return formFieldFactory.getInputField(
    _columnName,
    modifiedProperty,
    choices,
    readOnly,
  );
};

export default TargetType;