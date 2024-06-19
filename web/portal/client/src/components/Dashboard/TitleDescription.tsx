import { LightButton } from '@irontec/ivoz-ui/components/shared/Button/Button.styles';
import _ from '@irontec/ivoz-ui/services/translations/translate';
import { useStoreState } from 'store';

export const TitleDescription = (): JSX.Element => {
  const aboutMe = useStoreState((state) => state.clientSession.aboutMe.profile);
  if (aboutMe?.wholesale) {
    return (
      <div>
        <h3>{_('Welcome to </br> Ivoz Provider wholesale client portal')}</h3>
        <p>
          {_(
            'In this portal you can add wholesale accounts, manage Rating Profiles and much more.'
          )}
        </p>
        <a href='/doc/en/administration_portal/client/wholesale/index.html'>
          <LightButton>{_('Get started')}</LightButton>
        </a>
      </div>
    );
  }

  if (aboutMe?.retail) {
    return (
      <div>
        <h3>{_('Welcome to </br> Ivoz Provider retail client portal')}</h3>
        <p>
          {_(
            'In this portal you can add retail accounts, manage DDIs and much more.'
          )}
        </p>
        <a href='/doc/en/administration_portal/client/retail/index.html'>
          <LightButton>{_('Get started')}</LightButton>
        </a>
      </div>
    );
  }

  if (aboutMe?.residential) {
    return (
      <div>
        <h3>{_('Welcome to </br> Ivoz Provider residential client portal')}</h3>
        <p>
          {_(
            'In this portal you can add residential accounts, manage DDis and much more.'
          )}
        </p>
        <a href='/doc/en/administration_portal/client/residential/index.html'>
          <LightButton>{_('Get started')}</LightButton>
        </a>
      </div>
    );
  }

  return (
    <div>
      <h3>{_('Welcome to </br> Ivoz Provider vPBX client portal')}</h3>
      <p>
        {_(
          'In this portal you can add users, extensions, huntgroups and much more.'
        )}
      </p>
      <a href='/doc/en/administration_portal/client/vpbx/index.html'>
        <LightButton>{_('Get started')}</LightButton>
      </a>
    </div>
  );
};
