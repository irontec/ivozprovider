import { useStoreActions } from "store";
import { EntityValidator } from "@irontec/ivoz-ui/entities/EntityInterface";
import { Login as DefaultLogin } from "@irontec/ivoz-ui/components";

interface LoginProps {
  validator?: EntityValidator;
}

export default function Login(props: LoginProps): JSX.Element {
  const { validator } = props;

  const setToken = useStoreActions((actions) => actions.auth.setToken);
  const loadProfile = useStoreActions(
    (actions) => actions.clientSession.aboutMe.load
  );
  const setRefreshToken = useStoreActions(
    (actions) => actions.auth.setRefreshToken
  );
  const apiPost = useStoreActions((actions) => actions.api.post);

  const onSubmit = async (values: any) => {
    try {
      const response = await apiPost({
        path: "/admin_login",
        values,
        contentType: "application/x-www-form-urlencoded",
      });

      if (response.data && response.data.token) {
        setToken(response.data.token);
        setRefreshToken(response.data.refreshToken);
        await loadProfile();
      }

      return response;
    } catch (exception: any) {
      console.error(exception);
    }

    return {};
  };

  return <DefaultLogin onSubmit={onSubmit} validator={validator} />;
}
