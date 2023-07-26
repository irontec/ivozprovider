import withCustomComponentWrapper, {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';

import { IvrEntryPropertyList } from '../IvrEntryProperties';

type IvrEntryValues = IvrEntryPropertyList<
  string | number | Record<string, string | number>
>;
type TargetGhostType = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<IvrEntryValues>
>;

const Type: TargetGhostType = (props): JSX.Element => {
  const { values } = props;

  return <span>{values.target as React.ReactNode}</span>;
};

export default withCustomComponentWrapper<IvrEntryValues>(Type);
