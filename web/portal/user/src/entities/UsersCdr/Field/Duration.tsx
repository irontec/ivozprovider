import { ListDecorator } from '@irontec/ivoz-ui';
import {
  PropertyCustomFunctionComponent,
  PropertyCustomFunctionComponentProps,
} from '@irontec/ivoz-ui/services/form/Field/CustomComponentWrapper';
import { UsersCdrPropertyList } from '../UsersCdrProperties';

type DurationValues = UsersCdrPropertyList<string>;
type DurationTypeProps = PropertyCustomFunctionComponent<
  PropertyCustomFunctionComponentProps<DurationValues>
>;

const Duration: DurationTypeProps = (props): JSX.Element | null => {
  const { _columnName, property, values } = props;

  if (values?.duration) {
    values.duration = Math.ceil(values?.duration as number);
  }

  return (
    <ListDecorator
      field={_columnName}
      row={values}
      property={property}
      ignoreCustomComponent={true}
    />
  );
};

export default Duration;
