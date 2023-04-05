import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const Form = (props: EntityFormProps): JSX.Element => {
  const DefaultEntityForm = defaultEntityBehavior.Form;
  const edit = props.edit || false;

  const groups: Array<FieldsetGroups | false> = [
    {
      legend: '',
      fields: ['iden'],
    },
    {
      legend: '',
      fields: ['name'],
    },
    {
      legend: '',
      fields: ['description'],
    },
    {
      legend: '',
      fields: ['defaultCode'],
    },
    {
      legend: '',
      fields: ['extraArgs'],
    },
  ];

  return (
    <DefaultEntityForm
      {...props}
      readOnlyProperties={{ iden: edit, name: edit, description: edit }}
      groups={groups}
    />
  );
};

export default Form;
