import defaultEntityBehavior, {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const Form = (props: EntityFormProps): JSX.Element => {
  const DefaultEntityForm = defaultEntityBehavior.Form;

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

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
