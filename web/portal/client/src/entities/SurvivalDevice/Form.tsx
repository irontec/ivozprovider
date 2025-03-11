import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';

const Form = (props: EntityFormProps): JSX.Element => {
  const groups: Array<FieldsetGroups> = [
    {
      legend: 'Basic Settings',
      fields: ['name', 'proxy', 'outboundProxy', 'description'],
    },
    {
      legend: 'Ports',
      fields: ['udpPort', 'tcpPort', 'tlsPort', 'wssPort'],
    },
  ];

  return <DefaultEntityForm {...props} groups={groups} />;
};

export default Form;
