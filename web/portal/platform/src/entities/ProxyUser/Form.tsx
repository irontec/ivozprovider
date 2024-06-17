import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec-voip/ivoz-ui/entities/DefaultEntityBehavior/Form';

const Form = (props: EntityFormProps): JSX.Element => {
  const { row } = props;

  const readOnlyProperties = {
    name: row?.id === 1,
  };

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['name'],
    },
    {
      legend: '',
      fields: ['ip', 'advertisedIp'],
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
