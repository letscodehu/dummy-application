<?php

namespace Letscodehu;


class ProfileController
{

    private $viewFacade;

    /**
     * ProfileController constructor.
     * @param UserViewFacade $viewFacade
     */
    public function __construct(UserViewFacade $viewFacade)
    {
        $this->viewFacade = $viewFacade;
    }

    public function showProfile($id) {
        return $this->viewFacade->showProfile($id);
    }


}