import useFkChoices from '@irontec/ivoz-ui/entities/data/useFkChoices';
import {
  EntityFormProps,
  FieldsetGroups,
  Form as DefaultEntityForm,
} from '@irontec/ivoz-ui/entities/DefaultEntityBehavior';
import { PropertyList } from '@irontec/ivoz-ui/services/api/ParsedApiSpecInterface';
import { useStoreState } from 'store';

import Friend from '../Friend/Friend';
import ResidentialDevice from '../ResidentialDevice/ResidentialDevice';
import RetailAccount from '../RetailAccount/RetailAccount';
import User from '../User/User';
import { foreignKeyGetter } from './ForeignKeyGetter';

const Form = (props: EntityFormProps): JSX.Element => {
  const { entityService, row, match, properties } = props;

  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);

  const skip: Array<string> = [];
  if (aboutMe?.vpbx) {
    skip.push(...['cfwToRetailAccount', 'residentialDevice']);
  }

  if (aboutMe?.residential) {
    skip.push(...['retailAccount', 'cfwToRetailAccount', 'extension']);
  }

  if (aboutMe?.retail) {
    skip.push(...['residentialDevice', 'extension', 'voicemail']);
  }

  const fkChoices = useFkChoices({
    foreignKeyGetter,
    entityService,
    row,
    match,
    skip,
  });

  const newProperties = { ...properties };

  const userPath = match.pathname.includes(User.path);
  const friendPath = match.pathname.includes(Friend.path);
  const retailAccountPath = match.pathname.includes(RetailAccount.path);
  const residentialDevicePath = match.pathname.includes(ResidentialDevice.path);

  if (!retailAccountPath) {
    delete newProperties.cfwToRetailAccount;
    delete newProperties.ddi;
  }

  if (!residentialDevicePath) {
    delete newProperties.residentialDevice;
  }

  if (!userPath) {
    delete newProperties.user;
  }

  if (!friendPath) {
    delete newProperties.friend;
  }

  entityService.replaceProperties(newProperties as PropertyList);

  const groups: Array<FieldsetGroups> = [
    {
      legend: '',
      fields: [
        'enabled',
        !aboutMe?.retail && 'callTypeFilter',
        aboutMe?.retail && 'ddi',
        'callForwardType',
        'noAnswerTimeout',
        'targetType',
        aboutMe?.vpbx && 'extension',
        (aboutMe?.vpbx || aboutMe?.residential) && 'voicemail',
        'numberCountry',
        'numberValue',
        aboutMe?.retail && 'cfwToRetailAccount',
      ],
    },
  ];

  return <DefaultEntityForm {...props} fkChoices={fkChoices} groups={groups} />;
};

export default Form;
