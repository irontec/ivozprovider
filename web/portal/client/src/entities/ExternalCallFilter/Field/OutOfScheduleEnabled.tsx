import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { useStoreState } from '../../../store';
import ExternalCallFilter from '../ExternalCallFilter';

type OutOfScheduleEnabledProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<ExternalCallFilter>
>;

const OutOfScheduleEnabled: OutOfScheduleEnabledProps = (
  props
): JSX.Element | null => {
  const { _columnName, property, choices, readOnly, formFieldFactory } = props;
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  const residential = aboutMe?.residential;

  if (!formFieldFactory) {
    return null;
  }

  const modifiedProperty = { ...property } as ScalarProperty;
  delete modifiedProperty.component;

  if (residential) {
    modifiedProperty.label = {
      ...modifiedProperty.label,
      props: {
        ...modifiedProperty.label.props,
        defaults: 'Unconditional',
      },
    };
  }

  return formFieldFactory.getInputField(
    _columnName,
    modifiedProperty,
    choices,
    readOnly
  );
};

export default OutOfScheduleEnabled;
