import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';
import _ from '@irontec/ivoz-ui/services/translations/translate';

const Form = (props: EntityFormProps): JSX.Element => {
  const { row } = props;

  const readOnlyProperties = {
    name: row?.id === 1,
  };

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: _('Basic Configuration'),
      fields: ['name', 'ip'],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      readOnlyProperties={readOnlyProperties}
      groups={groups}
    />
  );
};

export default Form;
