import {
  EntityFormProps,
  FieldsetGroups,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { Form as DefaultEntityForm } from '@irontec/ivoz-ui/entities/DefaultEntityBehavior/Form';

const Form = (props: EntityFormProps): JSX.Element => {
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
      fields: ['genericUrlPattern'],
    },
    {
      legend: '',
      fields: [
        {
          name: 'genericTemplate',
          size: { md: 12, lg: 12, xl: 12 },
        },
      ],
    },
    {
      legend: '',
      fields: ['specificUrlPattern'],
    },
    {
      legend: '',
      fields: [
        {
          name: 'specificTemplate',
          size: { md: 12, lg: 12, xl: 12 },
        },
      ],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
